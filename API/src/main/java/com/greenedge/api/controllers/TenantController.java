package com.greenedge.api.controllers;

import com.greenedge.api.models.dtos.TenantDto;
import com.greenedge.api.models.entities.Tenant;
import com.greenedge.api.models.mappers.TenantMapper;
import com.greenedge.api.models.repositories.TenantRepository;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/tenants")
public class TenantController {

    private final TenantRepository tenantRepository;

    public TenantController(TenantRepository tenantRepository) {
        this.tenantRepository = tenantRepository;
    }

    @GetMapping
    public List<TenantDto> getAllTenants() {
        return tenantRepository.findAll().stream().map(TenantMapper::toDto).toList();
    }

    @PostMapping
    public TenantDto createTenant(@RequestBody TenantDto dto) {
        Tenant saved = tenantRepository.save(TenantMapper.toEntity(dto));
        return TenantMapper.toDto(saved);
    }
}
