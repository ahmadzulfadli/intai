#include "Max4466.h"

Max4466::Max4466(byte pin)
{
    this->pin = pin;
}
void Max4466::read()
{
    analogRead(pin);
}