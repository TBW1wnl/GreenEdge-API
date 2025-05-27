package com.greenedge.api.models.entities;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.Id;
import jakarta.persistence.Table;

@Entity
@Table(name = "INFRASTRUCTURES")
public class Infrastructure {
    @Id
    @GeneratedValue
    private long id;
}
