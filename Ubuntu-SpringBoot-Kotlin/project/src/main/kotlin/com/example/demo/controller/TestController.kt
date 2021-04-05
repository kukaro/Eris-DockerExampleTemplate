package com.example.demo.controller

import org.springframework.web.bind.annotation.GetMapping
import org.springframework.web.bind.annotation.RestController

@RestController
class TestController {

    @GetMapping(value = ["/test"])
    fun test(): String {
        return "PERSON TEST!!"
    }
}