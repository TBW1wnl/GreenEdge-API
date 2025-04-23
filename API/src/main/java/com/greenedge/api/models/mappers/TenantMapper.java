package com.greenedge.api.models.mappers;

import com.greenedge.api.models.dtos.TenantDto;
import com.greenedge.api.models.entities.Tenant;

public class TenantMapper {
    public static TenantDto toDto(Tenant tenant) {
        return new TenantDto(tenant.getId(), tenant.getName(), tenant.getDescription());
    }

    public static Tenant toEntity(TenantDto dto) {
        Tenant tenant = new Tenant();
        tenant.setName(dto.getName());
        tenant.setDescription(dto.getDescription());
        return tenant;
    }
}
