//RootController.java
package net.theceres.controller;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.servlet.ModelAndView;

@Controller
public class HelloController {

    @RequestMapping("/hello")
    public ModelAndView showMessage() {
        System.out.println("hello controller");
        ModelAndView mv = new ModelAndView("hello");
        return mv;
    }

}
