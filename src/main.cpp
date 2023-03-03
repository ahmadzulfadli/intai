#include <Arduino.h>
#include <WiFi.h>
#include <SPI.h>
#include <LoRa.h>

// Network ID
const char *ssid = "Raden Mas Wifi";
const char *password = "bebaspakai";
const char *host = "172.16.142.147";
const int port = 80;

// lora
#define ss 5
#define rst 14
#define dio0 2
int counter = 0;

/* void onReceive(int packetSize)
{
    // received a packet
    Serial.println("Received packet '");

    // read packet
    for (int i = 0; i < packetSize; i++)
    {
        Serial.print((char)LoRa.read());
    }
} */

void setup()
{
    // NodeMCU Utility
    Serial.begin(115200);

    // Lora
    while (!Serial)
        ;
    Serial.println("LoRa Receiver");
    LoRa.setPins(ss, rst, dio0);
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
        // received a packet
        Serial.print("Received packet '");

        // read packet
        while (LoRa.available())
        {
            String LoRaData = LoRa.readString();
            Serial.print(LoRaData);

            //===============================================================
            // collect data for 50 mS

            // nodemcuphp/index.php?mode=save&temperature=${temp}&humidity=${humid}
            String apiUrl = "http://intai.com/crud/kirim_data.php?";
            apiUrl += "mode=save";
            apiUrl += String(LoRaData);

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
    }

    //===============================================================
}