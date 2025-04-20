package com.greenedge.api.controllers;

import com.greenedge.api.models.dtos.GameDto;
import com.greenedge.api.services.GameService;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/games")
public class GameController {

    private final GameService gameService;

    public GameController(GameService gameService) {
        this.gameService = gameService;
    }

    @GetMapping
    public List<GameDto> getAllGames() {
        return gameService.getAllGames();
    }

    @GetMapping("/{id}")
    public GameDto getGameById(@PathVariable int id) {
        return gameService.getGameById(id);
    }

    @PostMapping
    public GameDto createGame(@RequestBody GameDto gameDto) {
        return gameService.createGame(gameDto);
    }

    @PutMapping("/{id}")
    public GameDto updateGame(@PathVariable int id, @RequestBody GameDto gameDto) {
        return gameService.updateGame(id, gameDto);
    }

    @DeleteMapping("/{id}")
    public void deleteGame(@PathVariable int id) {
        gameService.deleteGame(id);
    }
}
