package com.greenedge.api.models.dtos;

import com.greenedge.api.models.entities.Game;

public class GameDto {
    private int id;
    private String title;
    private String startDate;
    private int population;
    private int funds;
    private Short year;
    private Short month;
    private Short day;
    private Short globalWarming;
    private UserDto user;

    public GameDto() {}

    public GameDto(int id, String title, String startDate, int population, int funds, Short year, Short month, Short day, Short globalWarming, UserDto user) {
        this.id = id;
        this.title = title;
        this.startDate = startDate;
        this.population = population;
        this.funds = funds;
        this.year = year;
        this.month = month;
        this.day = day;
        this.globalWarming = globalWarming;
        this.user = user;
    }


    // Getters & Setters
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getStartDate() {
        return startDate;
    }

    public void setStartDate(String startDate) {
        this.startDate = startDate;
    }

    public int getPopulation() {
        return population;
    }

    public void setPopulation(int population) {
        this.population = population;
    }

    public int getFunds() {
        return funds;
    }

    public void setFunds(int funds) {
        this.funds = funds;
    }

    public Short getYear() {
        return year;
    }

    public void setYear(Short year) {
        this.year = year;
    }

    public Short getMonth() {
        return month;
    }

    public void setMonth(Short month) {
        this.month = month;
    }

    public Short getDay() {
        return day;
    }

    public void setDay(Short day) {
        this.day = day;
    }

    public Short getGlobalWarming() {
        return globalWarming;
    }

    public void setGlobalWarming(Short globalWarming) {
        this.globalWarming = globalWarming;
    }

    public UserDto getUser() {
        return user;
    }

    public void setUser(UserDto user) {
        this.user = user;
    }

}
