package com.greenedge.api.models.entities;
import jakarta.persistence.*;

@Entity
@Table(name = "TILES")
public class Tile {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int id;

    private String name;

    @ManyToOne
    private Game game;

    @Enumerated(EnumType.STRING)
    private TerrainType terrainType;

    @ManyToOne
    private Infrastructure RoadInfrastructure;

    @ManyToOne
    private Infrastructure SeaInfrastructure;

    @ManyToOne
    private Infrastructure AirInfrastructure;

    @ManyToOne
    private Infrastructure TrainInfrastructure;

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public TerrainType getTerrainType() {
        return terrainType;
    }

    public void setTerrainType(TerrainType terrainType) {
        this.terrainType = terrainType;
    }

    public Infrastructure getRoadInfrastructure() {
        return RoadInfrastructure;
    }

    public void setRoadInfrastructure(Infrastructure roadInfrastructure) {
        RoadInfrastructure = roadInfrastructure;
    }

    public Infrastructure getSeaInfrastructure() {
        return SeaInfrastructure;
    }

    public void setSeaInfrastructure(Infrastructure seaInfrastructure) {
        SeaInfrastructure = seaInfrastructure;
    }

    public Infrastructure getAirInfrastructure() {
        return AirInfrastructure;
    }

    public void setAirInfrastructure(Infrastructure airInfrastructure) {
        AirInfrastructure = airInfrastructure;
    }

    public Infrastructure getTrainInfrastructure() {
        return TrainInfrastructure;
    }

    public void setTrainInfrastructure(Infrastructure trainInfrastructure) {
        TrainInfrastructure = trainInfrastructure;
    }

    public Game getGame() {
        return game;
    }

    public void setGame(Game game) {
        this.game = game;
    }
}
