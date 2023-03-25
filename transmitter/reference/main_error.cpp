#include <config.h>

int countData = 1;

// variabel millis
const int timeSound = 1000;
const int sampleTimesound = 10000;
unsigned int sample1, sample2, sample3, sample4;

// sd card
SPIClass mySPI(VSPI);
File dataFile;

void database(int id, int dbmax1, int dbmax2, int dbmax3, int dbmax4, int status);

void setup()
{
    // NodeMCU Utility
    Serial.begin(9600);

    pinMode(LED_TRANS, OUTPUT);
    pinMode(LED_READ_DATA, OUTPUT);

    // Lora
    while (!Serial)
        ;
    Serial.println("LoRa Sender");
    LoRa.setPins(SS, RST, DIO0);
    if (!LoRa.begin(433E6))
    {
        Serial.println("Starting LoRa failed!");
        delay(100);
        while (1)
            ;
    }
    LoRa.setSyncWord(0x12); // set sync word

    // sd card
    mySPI.begin(SCK, MISO, MOSI, CHIP);
    if (!SD.begin(CHIP, mySPI))
    {
        Serial.println("initialization memory failed. Things to check:");
        while (1)
            ;
    }
    else
    {
        Serial.println("initialization memory success");
    }

    dataFile = SD.open("/data.json", FILE_WRITE);
    if (!dataFile)
    {
        Serial.println("Gagal membuka file data.json");
        return;
    }

    Serial.println("Memulai pengambilan data sensor...");
}

void loop()
{
    unsigned long startMillis = millis(); // Start of sample window

    unsigned int freq = 0;
    int db1, db2, db3, db4, status, i, sum1, sum2, sum3, sum4, arah;

    i = sum1 = sum2 = sum3 = sum4 = arah = 0;

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

        int mindb = 30;
        int maxdb = 150;

        peakToPeak1 = signalMax1 - signalMin1;         // max - min = peak-peak amplitude
        db1 = map(peakToPeak1, 0, 4095, mindb, maxdb); // calibrate for deciBels

        peakToPeak2 = signalMax2 - signalMin2;      // max - min = peak-peak amplitude
        db2 = map(peakToPeak2, 0, 4095, 20, maxdb); // calibrate for deciBels

        peakToPeak3 = signalMax3 - signalMin3;         // max - min = peak-peak amplitude
        db3 = map(peakToPeak3, 0, 4095, mindb, maxdb); // calibrate for deciBels

        peakToPeak4 = signalMax4 - signalMin4;         // max - min = peak-peak amplitude
        db4 = map(peakToPeak4, 0, 4095, mindb, maxdb); // calibrate for deciBels

        sum1 += db1;
        sum2 += db2;
        sum3 += db3;
        sum4 += db4;
        if (sum1 > sum2 && sum1 > sum3 && sum1 > sum4)
        {
            arah = 1;
        }
        else if (sum2 > sum1 && sum2 > sum3 && sum2 > sum4)
        {
            arah = 2;
        }
        else if (sum3 > sum1 && sum3 > sum2 && sum3 > sum4)
        {
            arah = 3;
        }
        else if (sum4 > sum1 && sum4 > sum2 && sum4 > sum3)
        {
            arah = 4;
        }

        // filter suara yang melebihi 90db
        if (db1 > 90 or db2 > 90 or db3 > 90 or db4 > 90)
        {
            freq++;
        }

        // jika freq 90db lebih dari 10 kali dali satu menit
        if (freq > 20)
        {
            status = 1;
        }
        else
        {
            status = 0;
            // arah = 0;
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
        Serial.println(arah);
        Serial.println(i);

        // save sd card
        database(i, db1, db2, db3, db4, status);

        digitalWrite(LED_READ_DATA, LOW);
        delay(1000);
    }
    // send packet
    LoRa.beginPacket();
    LoRa.write((byte *)&db1, sizeof(db1));
    LoRa.write((byte *)&db2, sizeof(db2));
    LoRa.write((byte *)&db3, sizeof(db3));
    LoRa.write((byte *)&db4, sizeof(db4));
    LoRa.write((byte *)&status, sizeof(status));
    LoRa.write((byte *)&arah, sizeof(arah));
    LoRa.write((byte *)&countData, sizeof(countData));
    LoRa.endPacket();

    countData++;

    digitalWrite(LED_TRANS, HIGH);
    delay(100);
    digitalWrite(LED_TRANS, LOW);
}

void database(int id, int dbmax1, int dbmax2, int dbmax3, int dbmax4, int status)
{
    // create object JSON document
    StaticJsonDocument<200> doc;

    // add data to the document
    doc["id"] = millis();
    doc["data_dbmax1"] = dbmax1;
    doc["data_dbmax2"] = dbmax2;
    doc["data_dbmax3"] = dbmax3;
    doc["data_dbmax4"] = dbmax4;
    doc["data_status"] = status;

    // serialize the JSON document to a string
    String jsonStr;
    serializeJson(doc, jsonStr);

    // write the string to the file and flush the file
    dataFile.println(jsonStr);
    dataFile.flush();

    Serial.println("Data written to file.");
}

void stopLogging()
{
    // close the file after logging is finished
    dataFile.close();
    Serial.println("Logging data selesai.");
}