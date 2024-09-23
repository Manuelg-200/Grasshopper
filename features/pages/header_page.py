from selenium.webdriver.common.by import By

class HeaderPage:
    def __init__(self, driver):
        self.driver = driver

    def find_button(self, button_text):
        xpath = f"//button[text()='{button_text}']"
        return self.driver.find_element(By.XPATH, xpath)    

    def click_button(self, button):
        self.find_button(button).click()

        
