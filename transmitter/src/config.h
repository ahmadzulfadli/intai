#ifndef INTAI_TRANS_CONFIG_H
#define INTAI_TRANS_CONFIG_H

#include <Arduino.h>
#include <SPI.h>
#include <LoRa.h>
#include <SD.h>
#include <ArduinoJson.h>

// lora
#define SS 5
#define RST 14
#define DIO0 2
#define LMOSI 23
#define LMISO 19
#define LSCK 18

// Deklarasi pin max4466
#define SENSOR_PIN1 34
#define SENSOR_PIN2 35
#define SENSOR_PIN3 32
#define SENSOR_PIN4 33

// deklarasi Led
#define LED_TRANS 26
#define LED_READ_DATA 27

// Deklarasi pin SD_card
#define CHIP 25
#define SCK 15
#define MISO 13
#define MOSI 12

#endif