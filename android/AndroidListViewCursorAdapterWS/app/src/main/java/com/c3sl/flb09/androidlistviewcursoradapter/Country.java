package com.c3sl.flb09.androidlistviewcursoradapter;

/**
 * Created by flb09 on 09/10/14.
 */
public class Country {

    String code = null;
    String name = null;
    String continent = null;
    String region = null;

    public Country(String code, String name, String continent, String region) {
        this.code=code;
        this.name=name;
        this.continent=continent;
        this.region=region;

    }

    public String getCode() {
        return code;
    }
    public void setCode(String code) {
        this.code = code;
    }
    public String getName() {
        return name;
    }
    public void setName(String name) {
        this.name = name;
    }
    public String getContinent() {
        return continent;
    }
    public void setContinent(String continent) {
        this.continent = continent;
    }
    public String getRegion() {
        return region;
    }
    public void setRegion(String region) {
        this.region = region;
    }
}
