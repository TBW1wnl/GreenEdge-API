package com.greenedge.api.models.repositories;

import com.greenedge.api.models.entities.Tenant;
import org.springframework.data.jpa.repository.JpaRepository;

public interface TenantRepository extends JpaRepository<Tenant, Integer> {}

