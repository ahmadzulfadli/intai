#ifndef MAX4466_H
#define MAX4466_H

#include <Arduino.h>

class Max4466
{

private:
    byte pin;

public:
    Max4466(byte pin);
    void read();
};

#endif