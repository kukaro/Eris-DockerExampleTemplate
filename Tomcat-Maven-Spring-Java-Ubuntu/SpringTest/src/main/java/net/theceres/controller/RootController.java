//RootController.java
package net.theceres.controller;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.servlet.ModelAndView;

@Controller
public class RootController {

    @RequestMapping("/")
    public ModelAndView showMessage() {
        System.out.println("index controller");
        ModelAndView mv = new ModelAndView("index");
        return mv;
    }

}
