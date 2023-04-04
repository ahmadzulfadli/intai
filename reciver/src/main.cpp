#include <Arduino.h>
#include <WiFi.h>
#include <SPI.h>
#include <LoRa.h>
#include <UrlEncode.h>

// Network ID
const char *ssid = "MyASUS";
const char *password = "hy12345678";
const char *host = "192.168.80.240";
const int port = 80;

/* // WhatsApp
String phoneNumber = "+6282268399552";
String apiKey = "REPLACE_WITH_API_KEY"; */

// lora
#define ss 5
#define rst 14
#define dio0 2
int counter = 0;

const long BAND = 433E6;     // frekuensi operasi LoRa
const int TX_POWER = 17;     // daya output LoRa
const long BAUD_RATE = 9600; // kecepatan data LoRa
const int BW = 125E3;        // bandwidth LoRa

void setup()
{
    // NodeMCU Utility
    Serial.begin(115200);

    // Lora
    while (!Serial)
        ;
    Serial.println("LoRa Receiver");
    LoRa.setPins(ss, rst, dio0);
    while (!LoRa.begin(BAND))
    {
        Serial.println(".");
        delay(500);
    }
    LoRa.setTxPower(TX_POWER);
    LoRa.setSpreadingFactor(12);
    LoRa.setSignalBandwidth(BW);
    LoRa.setCodingRate4(5);
    LoRa.enableCrc();
    Serial.println("LoRa Receiver Ready!");

    // Networking
    Serial.print("Connecting to ");
    Serial.println(ssid);
    WiFi.begin(ssid, password);
    while (WiFi.status() != WL_CONNECTED)
    {
        delay(500);
        Serial.print(".");
    }
    Serial.println("");
    Serial.println("WiFi connected.");
    Serial.println("IP address: ");
    Serial.println(WiFi.localIP());
}

void loop()
{
    // koneksi ke web client
    WiFiClient client;

    if (!client.connect(host, port))
    {
        Serial.println("Connection failed");
        return;
    }

    // penerimaan lora
    String receivedData = "";

    int packetSize = LoRa.parsePacket();
    if (packetSize != 0)
    {
        Serial.print("Received packet '");

        while (LoRa.available())
        {
            receivedData += (char)LoRa.read();
        }

        Serial.println(receivedData);

        char stringData[receivedData.length() + 1];
        strcpy(stringData, receivedData.c_str());

        char *ptr = strtok(stringData, ",");
        int i = 0;
        String data[6];

        while (ptr != NULL)
        {
            data[i] = String(ptr);
            i++;
            ptr = strtok(NULL, ",");
        }

        String db1 = data[0];
        String db2 = data[1];
        String db3 = data[2];
        String db4 = data[3];
        String status = data[4];
        String arah = data[5];

        Serial.print("' with RSSI ");
        Serial.println(LoRa.packetRssi());

        //===============================================================

        // pengiriman nilai sensor ke web server
        String apiUrl = "http://intai.com/crud/kirim_data.php?";
        apiUrl += "mode=save";
        apiUrl += "&suara1=" + db1;
        apiUrl += "&suara2=" + db2;
        apiUrl += "&suara3=" + db3;
        apiUrl += "&suara4=" + db4;
        apiUrl += "&status=" + status;
        apiUrl += "&arah=" + arah;

        // Set header Request
        client.print(String("GET ") + apiUrl + " HTTP/1.1\r\n" +
                     "Host: " + host + "\r\n" +
                     "Connection: close\r\n\r\n");

        // Pastikan tidak berlarut-larut
        unsigned long timeout = millis();
        while (client.available() == 0)
        {
            if (millis() - timeout > 3000)
            {
                Serial.println(">>> Client Timeout !");
                Serial.println(">>> Operation failed !");
                client.stop();
                return;
            }
        }

        // Baca hasil balasan dari PHP
        while (client.available())
        {
            String line = client.readStringUntil('\r');
            Serial.println(line);
        }
    }
}