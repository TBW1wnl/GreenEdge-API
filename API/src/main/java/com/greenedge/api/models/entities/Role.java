package com.greenedge.api.models.entities;

import jakarta.persistence.*;

@Entity
@Table(name = "ROLES")
public class Role {
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public GlobalRoleEnum getName() {
        return name;
    }

    public void setName(GlobalRoleEnum name) {
        this.name = name;
    }

    @Id
    @GeneratedValue
    private int id;

    @Enumerated(EnumType.STRING)
    private GlobalRoleEnum name;
}
