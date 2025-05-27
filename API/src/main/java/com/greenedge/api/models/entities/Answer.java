package com.greenedge.api.models.entities;

import jakarta.persistence.*;

@Entity
@Table(name = "ANSWERS")
public class Answer {
    @Id
    @GeneratedValue
    private long id;
    private String text;
    @ManyToOne
    private Event event;

    public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }

    public String getText() {
        return text;
    }

    public void setText(String text) {
        this.text = text;
    }

    public Event getEvent() {
        return event;
    }

    public void setEvent(Event event) {
        this.event = event;
    }
}
