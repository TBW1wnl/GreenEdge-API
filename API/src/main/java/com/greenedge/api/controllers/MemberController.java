package com.greenedge.api.controllers;

import com.greenedge.api.models.dtos.MemberDto;
import com.greenedge.api.models.entities.Member;
import com.greenedge.api.models.entities.OrgRoleEnum;
import com.greenedge.api.models.entities.Tenant;
import com.greenedge.api.models.entities.User;
import com.greenedge.api.models.repositories.MemberRepository;
import com.greenedge.api.models.repositories.TenantRepository;
import com.greenedge.api.models.repositories.UserRepository;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/tenants/{tenantId}/members")
public class MemberController {

    private final MemberRepository memberRepository;
    private final UserRepository userRepository;
    private final TenantRepository tenantRepository;

    public MemberController(MemberRepository memberRepository, UserRepository userRepository, TenantRepository tenantRepository) {
        this.memberRepository = memberRepository;
        this.userRepository = userRepository;
        this.tenantRepository = tenantRepository;
    }

    @GetMapping
    public List<MemberDto> getMembers(@PathVariable int tenantId) {
        return memberRepository.findByTenantId(tenantId).stream().map(member -> {
            return new MemberDto(
                    member.getId(),
                    member.getUser().getId(),
                    member.getTenant().getId(),
                    member.getRole().name()
            );
        }).toList();
    }

    @PostMapping
    public MemberDto addMember(@PathVariable int tenantId, @RequestBody MemberDto dto) {
        User user = userRepository.findById(dto.getUserId()).orElseThrow();
        Tenant tenant = tenantRepository.findById(tenantId).orElseThrow();

        Member member = new Member();
        member.setUser(user);
        member.setTenant(tenant);
        member.setRole(OrgRoleEnum.valueOf(dto.getOrgRole()));

        Member saved = memberRepository.save(member);
        return new MemberDto(saved.getId(), user.getId(), tenant.getId(), saved.getRole().name());
    }
}
