package com.greenedge.api.models.entities;

import jakarta.persistence.*;

import java.util.HashSet;
import java.util.Set;

@Entity
@Table(name = "TILES")
public class Tile {
    @Id
    @GeneratedValue
    private Long id;
    private String name;
    @ManyToMany
    private Set<Event> events = new HashSet<Event>();

}
