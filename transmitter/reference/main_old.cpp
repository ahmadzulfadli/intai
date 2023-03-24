#include <Arduino.h>
#include <SPI.h>
#include <LoRa.h>

// lora
#define ss 5
#define rst 14
#define dio0 2
int countData = 1;

// Deklarasi pin
#define SENSOR_PIN1 34
#define SENSOR_PIN2 35
#define SENSOR_PIN3 32
#define SENSOR_PIN4 33

// deklarasi Led
#define LED_TRANS 26
#define LED_READ_DATA 27
const int timeSound = 50; // Sample window width in mS (50 mS = 20Hz)
const int sampleTimesound = 60000;
unsigned int sample1, sample2, sample3, sample4;

void setup()
{
    // NodeMCU Utility
    Serial.begin(115200);

    pinMode(LED_TRANS, OUTPUT);
    pinMode(LED_READ_DATA, OUTPUT);

    // Lora
    while (!Serial)
        ;
    Serial.println("LoRa Sender");
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
}

void loop()
{
    unsigned long startMillis = millis(); // Start of sample window

    unsigned int freq = 0;
    int db1, db2, db3, db4, status;
    int i = 0;

    while (millis() - startMillis < sampleTimesound)
    {
        unsigned long startMillis2 = millis(); // Start of sample window

        unsigned int signalMax1 = 0;    // minimum value
        unsigned int signalMin1 = 4095; // maximum value
        unsigned int signalMax2 = 0;    // minimum value
        unsigned int signalMin2 = 4095; // maximum value
        unsigned int signalMax3 = 0;    // minimum value
        unsigned int signalMin3 = 4095; // maximum value
        unsigned int signalMax4 = 0;    // minimum value
        unsigned int signalMin4 = 4095; // maximum value

        // peak-to-peak level
        float peakToPeak1 = 0;
        float peakToPeak2 = 0;
        float peakToPeak3 = 0;
        float peakToPeak4 = 0;

        // collect data for 50 mS
        while (millis() - startMillis2 < timeSound)
        {
            digitalWrite(LED_READ_DATA, HIGH);
            sample1 = analogRead(SENSOR_PIN1); // get reading from microphone
            if (sample1 < 4095)                // toss out spurious readings
            {
                if (sample1 > signalMax1)
                {
                    signalMax1 = sample1; // save just the max levels
                }
                else if (sample1 < signalMin1)
                {
                    signalMin1 = sample1; // save just the min levels
                }
            }

            sample2 = analogRead(SENSOR_PIN2); // get reading from microphone
            if (sample2 < 4095)                // toss out spurious readings
            {
                if (sample2 > signalMax2)
                {
                    signalMax2 = sample2; // save just the max levels
                }
                else if (sample2 < signalMin2)
                {
                    signalMin2 = sample2; // save just the min levels
                }
            }
            sample3 = analogRead(SENSOR_PIN3); // get reading from microphone
            if (sample3 < 4095)                // toss out spurious readings
            {
                if (sample3 > signalMax3)
                {
                    signalMax3 = sample3; // save just the max levels
                }
                else if (sample3 < signalMin3)
                {
                    signalMin3 = sample3; // save just the min levels
                }
            }
            sample4 = analogRead(SENSOR_PIN4); // get reading from microphone
            if (sample4 < 4095)                // toss out spurious readings
            {
                if (sample4 > signalMax4)
                {
                    signalMax4 = sample4; // save just the max levels
                }
                else if (sample4 < signalMin4)
                {
                    signalMin4 = sample4; // save just the min levels
                }
            }
        }

        int mindb = 50;
        int maxdb = 100;
        int minread = 30;

        peakToPeak1 = signalMax1 - signalMin1;               // max - min = peak-peak amplitude
        db1 = map(peakToPeak1, minread, 4095, mindb, maxdb); // calibrate for deciBels

        peakToPeak2 = signalMax2 - signalMin2;               // max - min = peak-peak amplitude
        db2 = map(peakToPeak2, minread, 4095, mindb, maxdb); // calibrate for deciBels

        peakToPeak3 = signalMax3 - signalMin3;               // max - min = peak-peak amplitude
        db3 = map(peakToPeak3, minread, 4095, mindb, maxdb); // calibrate for deciBels

        peakToPeak4 = signalMax4 - signalMin4;               // max - min = peak-peak amplitude
        db4 = map(peakToPeak4, minread, 4095, mindb, maxdb); // calibrate for deciBels

        // filter suara yang melebihi 90db
        if (db1 > 90 or db2 > 90 or db3 > 90 or db4 > 90)
        {
            freq++;
        }

        // jika freq 90db lebih dari 10 kali dali satu menit
        if (freq > 40)
        {
            status = 1;
        }
        else
        {
            status = 0;
        }
        i++;
        Serial.print(db1);
        Serial.print(" ");
        Serial.print(db2);
        Serial.print(" ");
        Serial.print(db3);
        Serial.print(" ");
        Serial.println(db4);
        Serial.println(status);
        Serial.println(i);
        digitalWrite(LED_READ_DATA, LOW);
        delay(1000);
    }

    LoRa.beginPacket();
    LoRa.write((byte *)&db1, sizeof(db1));
    LoRa.write((byte *)&db2, sizeof(db2));
    LoRa.write((byte *)&db3, sizeof(db3));
    LoRa.write((byte *)&db4, sizeof(db4));
    LoRa.write((byte *)&status, sizeof(status));
    LoRa.write((byte *)&countData, sizeof(countData));
    LoRa.endPacket();

    /* Serial.println("==============");
    Serial.println(countData);
    Serial.println("=============="); */

    countData++;

    digitalWrite(LED_TRANS, HIGH);
    delay(100);
    digitalWrite(LED_TRANS, LOW);
}