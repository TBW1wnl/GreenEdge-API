package com.greenedge.api.models.entities;

import jakarta.persistence.*;

@Entity
@Table(name = "SITUATIONS")
public class Situation {
    @Id
    @GeneratedValue
    private long id;
    private float minValue;
    private float maxValue;
    private float value;
    @OneToOne
    private Event event;

    public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }

    public float getMinValue() {
        return minValue;
    }

    public void setMinValue(float minValue) {
        this.minValue = minValue;
    }

    public float getMaxValue() {
        return maxValue;
    }

    public void setMaxValue(float maxValue) {
        this.maxValue = maxValue;
    }

    public float getValue() {
        return value;
    }

    public void setValue(float value) {
        this.value = value;
    }

    public Event getEvent() {
        return event;
    }

    public void setEvent(Event event) {
        this.event = event;
    }
}
