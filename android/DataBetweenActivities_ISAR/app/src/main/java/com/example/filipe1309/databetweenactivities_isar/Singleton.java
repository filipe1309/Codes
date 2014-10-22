package com.example.filipe1309.databetweenactivities_isar;

/**
 * Created by filipe1309 on 21/10/14.
 */
public class Singleton {
    private static Singleton myInstance = null;
    private String singletonVar;
    private Singleton() {
        singletonVar = "Dados obtidos através de Singleton";
    }
    public static Singleton getInstance() {
        if(myInstance == null) {
            myInstance = new Singleton();
        }
        return myInstance;
    }
    public String getString() {
        return this.singletonVar;
    }
    public void setString(String value) {
        this.singletonVar = value;
    }
}
