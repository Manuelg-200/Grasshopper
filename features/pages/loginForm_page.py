from selenium.webdriver.common.by import By

class LoginFormPage:
    def __init__(self, driver):
        self.driver = driver
        self.email_input = (By.ID, 'email')

    def enter_email(self, email):
        self.driver.find_element(*self.email_input).send_keys(email)
    
    def get_email(self):
        return self.driver.find_element(*self.email_input).get_attribute('value')