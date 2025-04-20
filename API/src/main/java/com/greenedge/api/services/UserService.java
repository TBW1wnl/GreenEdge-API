package com.greenedge.api.services;

import com.greenedge.api.models.dtos.UserDto;
import com.greenedge.api.models.entities.User;
import com.greenedge.api.models.mappers.UserMapper;
import com.greenedge.api.models.repositories.UserRepository;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.stream.Collectors;

@Service
public class UserService {

    private final UserRepository userRepository;
    private final UserMapper userMapper;
    private final PasswordEncoder passwordEncoder;

    public UserService(UserRepository userRepository, UserMapper userMapper, PasswordEncoder passwordEncoder) {
        this.userRepository = userRepository;
        this.userMapper = userMapper;
        this.passwordEncoder = passwordEncoder;
    }

    public List<UserDto> getAllUsers() {
        return userRepository.findAll()
                .stream()
                .map(userMapper::toDto)
                .collect(Collectors.toList());
    }

    public UserDto getUserById(int id) {
        return userRepository.findById(id)
                .map(userMapper::toDto)
                .orElse(null);
    }

    public UserDto createUser(UserDto dto) {
        if (userRepository.findByEmail(dto.getEmail()).isPresent()) {
            throw new RuntimeException("Email is already in use");
        }
        User user = userMapper.toEntity(dto);
        user.setPassword(passwordEncoder.encode(dto.getPassword()));
        User saved = userRepository.save(user);
        return userMapper.toDto(saved);
    }



    public UserDto updateUser(int id, UserDto dto) {
        return userRepository.findById(id).map(existing -> {
            existing.setUsername(dto.getUsername());
            existing.setFirstName(dto.getFirstName());
            existing.setLastName(dto.getLastName());
            existing.setEmail(dto.getEmail());
            existing.setPhone(dto.getPhone());
            if (dto.getPassword() != null && !dto.getPassword().isEmpty()) {
                existing.setPassword(passwordEncoder.encode(dto.getPassword()));
            }
            User saved = userRepository.save(existing);
            return userMapper.toDto(saved);
        }).orElse(null);
    }


    public void deleteUser(int id) {
        userRepository.deleteById(id);
    }
}
