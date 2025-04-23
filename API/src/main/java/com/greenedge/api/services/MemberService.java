package com.greenedge.api.services;

import com.greenedge.api.models.dtos.MemberDto;
import com.greenedge.api.models.entities.Member;
import com.greenedge.api.models.entities.OrgRoleEnum;
import com.greenedge.api.models.entities.Tenant;
import com.greenedge.api.models.entities.User;
import com.greenedge.api.models.repositories.MemberRepository;
import com.greenedge.api.models.repositories.TenantRepository;
import com.greenedge.api.models.repositories.UserRepository;
import org.springframework.stereotype.Service;

@Service
public class MemberService {

    private final MemberRepository memberRepository;
    private final TenantRepository tenantRepository;
    private final UserRepository userRepository;

    public MemberService(MemberRepository memberRepository,
                         TenantRepository tenantRepository,
                         UserRepository userRepository) {
        this.memberRepository = memberRepository;
        this.tenantRepository = tenantRepository;
        this.userRepository = userRepository;
    }

    public MemberDto addMemberToTenant(int tenantId, int userId, String orgRole) {
        // Vérifie si l'utilisateur est déjà membre
        if (memberRepository.findByUserIdAndTenantId(userId, tenantId).isPresent()) {
            throw new IllegalArgumentException("User is already a member of this tenant.");
        }

        User user = userRepository.findById(userId)
                .orElseThrow(() -> new RuntimeException("User not found"));

        Tenant tenant = tenantRepository.findById(tenantId)
                .orElseThrow(() -> new RuntimeException("Tenant not found"));

        Member member = new Member();
        member.setUser(user);
        member.setTenant(tenant);
        member.setRole(OrgRoleEnum.valueOf(orgRole.toUpperCase())); // "ADMIN" or "MEMBER"

        Member saved = memberRepository.save(member);

        return new MemberDto(saved.getId(), userId, tenantId, saved.getRole().name());
    }
}
