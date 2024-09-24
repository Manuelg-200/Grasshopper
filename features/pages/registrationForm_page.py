from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import StaleElementReferenceException

class RegistrationFormPage:
    def __init__(self, driver):
        self.driver = driver
        self.wait = WebDriverWait(driver, 10)

        self.name_input = self.driver.find_element(By.ID, 'firstname')
        self.surname_input = self.driver.find_element(By.ID, 'lastname')
        self.email_input = self.driver.find_element(By.ID, 'email')
        self.password_input = self.driver.find_element(By.ID, 'pass')
        self.confirm_password_input = self.driver.find_element(By.ID, 'confirm')
        
    def fill_name(self, name):
        self.name_input.send_keys(name)

    def fill_surname(self, surname):
        self.surname_input.send_keys(surname)
    
    def fill_email(self, email):
        self.email_input.send_keys(email)
    
    def fill_password(self, password):
        self.password_input.send_keys(password)
    
    def fill_confirm_password(self, confirm_password):
        self.confirm_password_input.send_keys(confirm_password)

    def fill_in_everything(self, name, surname, email, password, confirm_password):
        self.fill_name(name)
        self.fill_surname(surname)
        self.fill_email(email)
        self.fill_password(password)
        self.fill_confirm_password(confirm_password)

    def click_subscribe(self):
        try:
            self.subscribe_button = self.wait.until(EC.element_to_be_clickable((By.ID, 'Submit')))
            self.subscribe_button.click()
        except StaleElementReferenceException:
            self.subscribe_button = self.wait.until(EC.element_to_be_clickable((By.ID, 'Submit')))
            self.subscribe_button.click()

        


