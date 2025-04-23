package com.greenedge.api.models.dtos;

public class DetailedMemberDto {
    private int id;
    private UserDto user;
    private TenantDto tenant;
    private String orgRole;

    public DetailedMemberDto() {}

    public DetailedMemberDto(int id, UserDto user, TenantDto tenant, String orgRole) {
        this.id = id;
        this.user = user;
        this.tenant = tenant;
        this.orgRole = orgRole;
    }

    // Getters & Setters
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public UserDto getUser() {
        return user;
    }

    public void setUser(UserDto user) {
        this.user = user;
    }

    public TenantDto getTenant() {
        return tenant;
    }

    public void setTenant(TenantDto tenant) {
        this.tenant = tenant;
    }

    public String getOrgRole() {
        return orgRole;
    }

    public void setOrgRole(String orgRole) {
        this.orgRole = orgRole;
    }
}
