package com.greenedge.api.services;

import com.greenedge.api.models.dtos.GameDto;
import com.greenedge.api.models.entities.Game;
import com.greenedge.api.models.entities.User;
import com.greenedge.api.models.repositories.GameRepository;
import com.greenedge.api.models.repositories.UserRepository;
import com.greenedge.api.models.mappers.GameMapper;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.stream.Collectors;

@Service
public class GameService {

    private final GameRepository gameRepository;
    private final UserRepository userRepository;
    private final GameMapper gameMapper;

    public GameService(GameRepository gameRepository, UserRepository userRepository, GameMapper gameMapper) {
        this.gameRepository = gameRepository;
        this.userRepository = userRepository;
        this.gameMapper = gameMapper;
    }

    public List<GameDto> getAllGames() {
        return gameRepository.findAll()
                .stream()
                .map(gameMapper::toDto)
                .collect(Collectors.toList());
    }

    public GameDto getGameById(int id) {
        return gameRepository.findById(id)
                .map(gameMapper::toDto)
                .orElse(null); // tu peux throw une 404 ici
    }

    public GameDto createGame(GameDto dto) {
        User user = userRepository.findById(dto.getUser().getId())
                .orElseThrow(() -> new RuntimeException("User not found"));
        Game game = gameMapper.toEntity(dto);
        game.setUser(user); // on associe l’utilisateur à l’entité
        return gameMapper.toDto(gameRepository.save(game));
    }

    public GameDto updateGame(int id, GameDto dto) {
        return gameRepository.findById(id).map(existingGame -> {
            existingGame.setTitle(dto.getTitle());
            existingGame.setStartDate(dto.getStartDate());
            existingGame.setPopulation(dto.getPopulation());
            existingGame.setFunds(dto.getFunds());
            existingGame.setYear(dto.getYear());
            existingGame.setMonth(dto.getMonth());
            existingGame.setDay(dto.getDay());
            existingGame.setGlobalWarming(dto.getGlobalWarming());

            if (dto.getUser() != null) {
                userRepository.findById(dto.getUser().getId()).ifPresent(existingGame::setUser);
            }

            return gameMapper.toDto(gameRepository.save(existingGame));
        }).orElse(null);
    }

    public void deleteGame(int id) {
        gameRepository.deleteById(id);
    }
}
