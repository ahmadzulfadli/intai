#include <Wire.h>
#include <Adafruit_Sensor.h>
#include <Adafruit_BME280.h>
#include <SPI.h>
#include <SD.h>
#include <ArduinoJson.h>

#define SEALEVELPRESSURE_HPA (1013.25)

Adafruit_BME280 bme; // inisialisasi BME280
File dataFile;       // inisialisasi SD card

void setup()
{
    Serial.begin(9600);
    while (!Serial)
        ;

    if (!bme.begin(0x76))
    { // cek koneksi BME280
        Serial.println("Could not find a valid BME280 sensor, check wiring!");
        while (1)
            ;
    }

    Serial.print("Initializing SD card...");
    if (!SD.begin(5))
    { // cek koneksi SD card
        Serial.println("initialization failed!");
        while (1)
            ;
    }
    Serial.println("initialization done.");

    dataFile = SD.open("datalog.json", FILE_WRITE); // buat atau buka file datalog.json
    if (dataFile)
    {
        dataFile.println("Starting new data logging session.");
        dataFile.close();
    }
    else
    {
        Serial.println("error opening datalog.json");
    }
}

void loop()
{
    delay(2000);

    // baca suhu, kelembaban, dan tekanan atmosfer
    float temperature = bme.readTemperature();
    float humidity = bme.readHumidity();
    float pressure = bme.readPressure() / 100.0F;

    // hitung ketinggian berdasarkan tekanan atmosfer dan suhu
    float altitude = bme.readAltitude(SEALEVELPRESSURE_HPA);

    // buat objek JSON dan simpan data ke dalamnya
    StaticJsonDocument<200> jsonDoc;
    jsonDoc["temperature"] = temperature;
    jsonDoc["humidity"] = humidity;
    jsonDoc["pressure"] = pressure;
    jsonDoc["altitude"] = altitude;

    // buka file datalog.json dan simpan data dalam format JSON
    dataFile = SD.open("datalog.json", FILE_WRITE);
    if (dataFile)
    {
        serializeJson(jsonDoc, dataFile);
        dataFile.println();
        dataFile.close();
    }
    else
    {
        Serial.println("error opening datalog.json");
    }
}
