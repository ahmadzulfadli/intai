#include <Arduino.h>
#include <WiFi.h>

// Network ID
const char *ssid = "MyASUS";
const char *password = "hy12345678";
const char *host = "192.168.108.240";
const int port = 80;

// Current time
unsigned long currentTime = millis();
// Previous time
unsigned long previousTime = 0;
// Define timeout time in milliseconds (example: 2000ms = 2s)
const long timeoutTime = 2000;

void setup()
{
    // NodeMCU Utility
    Serial.begin(9600);

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

    // DHT get temp dan humid
    float temp = random(50, 100);
    float humid = random(50, 100);
    float sound = random(50, 100);

    // nodemcuphp/index.php?mode=save&temperature=${temp}&humidity=${humid}
    String apiUrl = "http://monitoringdht11.com/kirim_data.php?";
    apiUrl += "mode=save";
    apiUrl += "&temperature=" + String(temp);
    apiUrl += "&humidity=" + String(humid);
    apiUrl += "&kebisingan=" + String(sound);

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
    delay(30000);
}