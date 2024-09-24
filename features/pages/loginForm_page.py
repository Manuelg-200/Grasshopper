from selenium.webdriver.common.by import By

class LoginFormPage:
    def __init__(self, driver):
        self.driver = driver
        self.email_input = self.driver.find_element(By.ID, 'email')
        self.password_input = self.driver.find_element(By.ID, 'pass')
        self.login_button = self.driver.find_element(By.ID, 'Submit')

    def enter_email(self, email):
        self.email_input.send_keys(email)

    def enter_password(self, password):
        self.password_input.send_keys(password)

    def fill_in_everything(self, email, password):
        self.enter_email(email)
        self.enter_password(password)
    
    def click_login(self):
        self.login_button.click()
        
    def get_email(self):
        return self.driver.find_element(*self.email_input).get_attribute('value')