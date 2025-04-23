package com.greenedge.api.models.entities;

import jakarta.persistence.*;

@Entity
@Table(name = "MEMBERS")
public class Member {
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public User getUser() {
        return user;
    }

    public void setUser(User user) {
        this.user = user;
    }

    public Tenant getTenant() {
        return tenant;
    }

    public void setTenant(Tenant tenant) {
        this.tenant = tenant;
    }

    public OrgRoleEnum getRole() {
        return role;
    }

    public void setRole(OrgRoleEnum role) {
        this.role = role;
    }

    @Id @GeneratedValue
    private int id;

    @ManyToOne
    private User user;

    @ManyToOne
    private Tenant tenant;

    @Enumerated(EnumType.STRING)
    private OrgRoleEnum role;
}
