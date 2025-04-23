package com.greenedge.api.models.repositories;

import com.greenedge.api.models.entities.Member;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;
import java.util.Optional;

public interface MemberRepository extends JpaRepository<Member, Integer> {
    List<Member> findByTenantId(int tenantId);
    List<Member> findByUserId(int userId);
    Optional<Member> findByUserIdAndTenantId(int userId, int tenantId);
}