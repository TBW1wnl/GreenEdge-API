package com.greenedge.api.models.dtos;

public class RoleDto {
    private int id;
    private String name;

    public RoleDto() {}

    public RoleDto(int id, String name) {
        this.id = id;
        this.name = name;
    }

    // Getters & Setters
    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }
}
