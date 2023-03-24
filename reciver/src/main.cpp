#include <Arduino.h>
#include <WiFi.h>
#include <SPI.h>
#include <LoRa.h>
#include <UrlEncode.h>

// Network ID
const char *ssid = "Raden Mas Wifi";
const char *password = "bebaspakai";
const char *host = "172.16.142.151";
const int port = 80;

/* // WhatsApp
String phoneNumber = "+6282268399552";
String apiKey = "REPLACE_WITH_API_KEY"; */

// lora
#define ss 5
#define rst 14
int counter = 0;

int db1, db2, db3, db4, status, countData;

void setup()
{
    // NodeMCU Utility
    Serial.begin(115200);

    // Lora
    while (!Serial)
        ;
    Serial.println("LoRa Receiver");
    LoRa.setPins(ss, rst);
    if (!LoRa.begin(433E6))
    {
        Serial.println("Starting LoRa failed!");
        delay(100);
        while (1)
            ;
    }
    LoRa.setSyncWord(0x12); // set sync word
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
    WiFiClient client;

    if (!client.connect(host, port))
    {
        Serial.println("Connection failed");
        return;
    }

    // try to parse packet
    int packetSize = LoRa.parsePacket();
    if (packetSize)
    {

        Serial.println("Received packet");

        // read db1
        int db1;
        LoRa.readBytes((byte *)&db1, sizeof(db1));
        Serial.print("db1: ");
        Serial.println(db1);

        // read db2
        int db2;
        LoRa.readBytes((byte *)&db2, sizeof(db2));
        Serial.print("db2: ");
        Serial.println(db2);

        // read db3
        int db3;
        LoRa.readBytes((byte *)&db3, sizeof(db3));
        Serial.print("db3: ");
        Serial.println(db3);

        // read db4
        int db4;
        LoRa.readBytes((byte *)&db4, sizeof(db4));
        Serial.print("db4: ");
        Serial.println(db4);

        // read status
        int status;
        LoRa.readBytes((byte *)&status, sizeof(status));
        Serial.print("status: ");
        Serial.println(status);

        // read arah
        int arah;
        LoRa.readBytes((byte *)&arah, sizeof(arah));
        Serial.print("arah: ");
        Serial.println(arah);

        // read countData
        int countData;
        LoRa.readBytes((byte *)&countData, sizeof(countData));
        Serial.print("countData: ");
        Serial.println(countData);

        // send data to website
        String apiUrl = "http://intai.com/crud/kirim_data.php?";
        apiUrl += "mode=save";
        apiUrl += "&suara1=" + String(db1);
        apiUrl += "&suara2=" + String(db2);
        apiUrl += "&suara3=" + String(db3);
        apiUrl += "&suara4=" + String(db4);
        apiUrl += "&status=" + String(status);

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

    // print RSSI of packet
    Serial.print("' with RSSI ");
    Serial.println(LoRa.packetRssi());

    //===============================================================
}