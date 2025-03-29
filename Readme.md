# Real-Time IoT Attendance System Using NodeMCU ESP8266 and RFID

## 1. Introduction
This project implements a real-time IoT-based attendance system using the **NodeMCU ESP8266** and **RFID RC522** reader. The system scans RFID cards to mark attendance, processes the data through an API, and displays responses on an **I2C 16x2 LCD** display. It also provides feedback using **LED indicators** and a **buzzer** for status notifications.

## 2. Components Used
### Hardware Components:
- **NodeMCU ESP8266**
- **RFID RC522 Reader**
- **I2C 16x2 LCD Display**
- **5V Buzzer**
- **3 LED Lights (Red, Green, Blue)**
- **Jumper Wires**
- **Breadboard**

### Software Requirements:
- **Arduino IDE**
- **ESP8266 Board Package**
- **Required Libraries**

## 3. Circuit Diagram & Connections
### RFID Module (RC522):
- VCC  ->  3.3V
- GND  ->  GND
- SDA  ->  D4 (GPIO2)
- SCK  ->  D5 (GPIO14)
- MOSI ->  D7 (GPIO13)
- MISO ->  D6 (GPIO12)
- RST  ->  D3 (GPIO0)

### LCD I2C Display:
- SCL  ->  D1 (GPIO5)
- SDA  ->  D2 (GPIO4)
- VCC  ->  5V
- GND  ->  GND

### Buzzer:
- Positive -> D8 (GPIO15)
- Negative -> GND

### LED Connections:
- Green LED: Anode -> D0 (GPIO16), Cathode -> GND (via resistor)
- Red LED:   Anode -> RX (GPIO3), Cathode -> GND (via resistor)
- Blue LED:  Anode -> TX (GPIO1), Cathode -> GND (via resistor)

## 4. Installation of Required Libraries
To run this project, install the following libraries in **Arduino IDE**:
```cpp
#include <ESP8266WiFi.h>
#include <Wire.h>
#include <LiquidCrystal_PCF8574.h>
#include <SPI.h>
#include <MFRC522.h>
#include <ESP8266HTTPClient.h>
#include <ArduinoJson.h>
#include <WiFiClientSecure.h>
```

## 5. Code Implementation
```cpp
#include <ESP8266WiFi.h>
#include <Wire.h>
#include <LiquidCrystal_PCF8574.h>
#include <SPI.h>
#include <MFRC522.h>
#include <ESP8266HTTPClient.h>
#include <ArduinoJson.h>
#include <WiFiClientSecure.h>

#define SDA_PIN D2
#define SCL_PIN D1
#define RST_PIN D3
#define SS_PIN D4

#define BUZZER D8
#define GREEN D0
#define RED RX
#define BLUE TX

LiquidCrystal_PCF8574 lcd(0x27);
MFRC522 mfrc522(SS_PIN, RST_PIN);

const char* ssid = "your_wifi_ssid";
const char* password = "your_wifi_password";
const char* serverUrl = "your_api_url";

void setup() {
  SPI.begin();
  mfrc522.PCD_Init();
  Wire.begin(SDA_PIN, SCL_PIN);
  lcd.begin(16, 2);
  lcd.setBacklight(10);
  pinMode(BUZZER, OUTPUT);
  pinMode(GREEN, OUTPUT);
  pinMode(RED, OUTPUT);
  pinMode(BLUE, OUTPUT);

  digitalWrite(BUZZER, LOW);
  digitalWrite(BLUE, HIGH);
  Serial.begin(115200);
  connectToWiFi();
  showMessage("Scan Your Card");
}

void loop() {
  String uid = getRFIDUID();
  if (!uid.isEmpty()) {
    sendRFIDData(uid);
    delay(2000);
  }
}

void connectToWiFi() {
  showMessage("Connecting to WiFi...");
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("\nWiFi Connected!");
  showMessage("WiFi Connected", WiFi.localIP().toString());
}

String getRFIDUID() {
  if (!mfrc522.PICC_IsNewCardPresent() || !mfrc522.PICC_ReadCardSerial())
    return "";

  String uid = "";
  for (byte i = 0; i < mfrc522.uid.size; i++) {
    uid += String(mfrc522.uid.uidByte[i], HEX);
  }
  mfrc522.PICC_HaltA();
  return uid;
}

void sendRFIDData(String uid) {
  showMessage("Checking...");
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    WiFiClient client;
    http.begin(client, serverUrl);
    http.addHeader("Content-Type", "application/json");
    
    StaticJsonDocument<200> jsonDoc;
    jsonDoc["uid"] = uid;
    String requestBody;
    serializeJson(jsonDoc, requestBody);
    
    int httpResponseCode = http.POST(requestBody);
    if (httpResponseCode > 0) {
      String response = http.getString();
      StaticJsonDocument<200> responseDoc;
      if (deserializeJson(responseDoc, response) == DeserializationError::Ok) {
        int statusCode = responseDoc["status_code"];
        String message1 = responseDoc["message1"];
        showMessage(message1);
        if (statusCode == 200) {
          digitalWrite(GREEN, HIGH);
          digitalWrite(BUZZER, HIGH);
          delay(200);
          digitalWrite(GREEN, LOW);
          digitalWrite(BUZZER, LOW);
        } else {
          digitalWrite(RED, HIGH);
          digitalWrite(BUZZER, HIGH);
          delay(1000);
          digitalWrite(RED, LOW);
          digitalWrite(BUZZER, LOW);
        }
      }
    }
    http.end();
  }
}

void showMessage(String line1, String line2 = "") {
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print(line1);
  lcd.setCursor(0, 1);
  lcd.print(line2);
}
```

## 6. Features & Functionality
- **Scans RFID cards and retrieves UID**
- **Sends UID to API for validation**
- **Displays response messages on LCD**
- **Uses LED indicators & buzzer for feedback**
- **Reconnects to WiFi if disconnected**

## 7. Conclusion
This project provides an efficient and real-time attendance system using IoT technology. The integration of the **NodeMCU ESP8266, RFID RC522**, and **cloud API** ensures seamless communication and monitoring. It can be further expanded for use in schools, offices, and secured environments.

---
**Future Enhancements:**
- **Database Integration for real-time logging**
- **Mobile App for attendance monitoring**
- **Biometric authentication for enhanced security**

