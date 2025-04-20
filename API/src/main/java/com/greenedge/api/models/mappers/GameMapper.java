package com.greenedge.api.models.mappers;

import com.greenedge.api.models.dtos.GameDto;
import com.greenedge.api.models.entities.Game;
import org.mapstruct.*;

@Mapper(componentModel = "spring", uses = { UserMapper.class })
public interface GameMapper {
    GameDto toDto(Game game);
    Game toEntity(GameDto gameDto);
}

