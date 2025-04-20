package com.greenedge.api.controllers;

import com.greenedge.api.services.JWTService;
import com.greenedge.api.models.dtos.UserDto;
import com.greenedge.api.models.entities.User;
import com.greenedge.api.models.repositories.UserRepository;
import org.springframework.security.authentication.AuthenticationManager;
import org.springframework.security.authentication.UsernamePasswordAuthenticationToken;
import org.springframework.security.core.AuthenticationException;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/auth")
public class AuthenticationController {

    private final AuthenticationManager authenticationManager;
    private final JWTService jwtService;
    private final UserRepository userRepository;

    public AuthenticationController(AuthenticationManager authenticationManager, JWTService jwtService, UserRepository userRepository) {
        this.authenticationManager = authenticationManager;
        this.jwtService = jwtService;
        this.userRepository = userRepository;
    }

    @PostMapping("/login")
    public String login(@RequestBody UserDto dto) {
        try {
            authenticationManager.authenticate(
                    new UsernamePasswordAuthenticationToken(dto.getEmail(), dto.getPassword())
            );
            return jwtService.generateToken(dto.getEmail());

        } catch (AuthenticationException e) {
            throw new RuntimeException("Invalid credentials");
        }
    }
}
