#include <WiFi.h>
#include <HTTPClient.h>

const char *ssid = "Raden Mas Wifi"; // Nama Wifi
const char *password = "bebaspakai"; // pass wifi

float h, t;

void read_dht()
{
    h = random(50, 100);
    t = random(50, 100);

    // Check if any reads failed and exit early (to try again).
    if (isnan(h) || isnan(t))
    {
        Serial.println(F("Failed to read from DHT sensor!"));
        return;
    }
    Serial.print(F("Humidity: "));
    Serial.print(h);
    Serial.print(F("%  Temperature: "));
    Serial.print(t);
    Serial.println(F("°C "));
}

void kirim_data()
{

    float tegangan, arus, suhu, kelembaban;
    tegangan = random(0, 12); // ubah dengan data dari sensor
    arus = random(0, 3);      // ubah dengan data dari sensor
    suhu = t;
    kelembaban = h;

    String postData = (String) "tegangan=" + tegangan + "&arus=" + arus + "&suhu=" + suhu + "&kelembaban=" + kelembaban;

    HTTPClient http;
    http.begin("http://127.0.0.1:80/");
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    auto httpCode = http.POST(postData);
    String payload = http.getString();

    Serial.println(postData);
    Serial.println(payload);

    http.end();
}

void setup()
{
    delay(1000);
    Serial.begin(9600);
    WiFi.mode(WIFI_OFF);
    delay(1000);
    WiFi.mode(WIFI_STA);

    WiFi.begin(ssid, password);
    Serial.println("");

    Serial.print("Connecting");
    // Wait for connection
    while (WiFi.status() != WL_CONNECTED)
    {
        delay(500);
        Serial.print(".");
    }

    Serial.println("");
    Serial.print("Connected to ");
    Serial.println(ssid);
    Serial.print("IP address: ");
    Serial.println(WiFi.localIP()); // IP address assigned to your ESP
}

void loop()
{

    if (Serial.available())
    {
        int a = Serial.parseInt();

        if (a > 0)
        {
            read_dht();
            kirim_data();
        }
    }
}
