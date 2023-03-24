#include <SPI.h>
#include <SD.h>
#include <ArduinoJson.h>

SPIClass mySPI(VSPI);
const int chipSelect = 25;
File dataFile;

void database(int dbmax1, int dbmax2, int dbmax3, int dbmax4, int status);

void setup()
{
    // Open serial communications and wait for port to open:
    Serial.begin(115200);
    while (!Serial)
    {
        ; // wait for serial port to connect. Needed for native USB port only
    }

    Serial.print("\nInitializing SD card...");
    mySPI.begin(15, 13, 12, chipSelect);
    if (!SD.begin(chipSelect, mySPI))
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

void loop(void)
{
    // generate random data
    int dbmax1 = random(0, 100);
    int dbmax2 = random(0, 100);
    int dbmax3 = random(0, 100);
    int dbmax4 = random(0, 100);
    int status = 1;

    // save data to SD card
    database(dbmax1, dbmax2, dbmax3, dbmax4, status);

    // wait for 5 seconds
    delay(5000);
}

void database(int dbmax1, int dbmax2, int dbmax3, int dbmax4, int status)
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
