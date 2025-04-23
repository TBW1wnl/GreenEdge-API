package com.greenedge.api.models.dtos;

public class MemberDto {
    private int id;
    private int userId;
    private int tenantId;
    private String orgRole;

    public MemberDto() {}

    public MemberDto(int id, int userId, int tenantId, String orgRole) {
        this.id = id;
        this.userId = userId;
        this.tenantId = tenantId;
        this.orgRole = orgRole;
    }

    // Getters & Setters
    public String getOrgRole() {
        return orgRole;
    }

    public void setOrgRole(String orgRole) {
        this.orgRole = orgRole;
    }

    public int getTenantId() {
        return tenantId;
    }

    public void setTenantId(int tenantId) {
        this.tenantId = tenantId;
    }

    public int getUserId() {
        return userId;
    }

    public void setUserId(int userId) {
        this.userId = userId;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }
}
