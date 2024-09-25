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

        self.subscribe_button = self.driver.find_element(By.ID, 'Submit')

    def findField(self, field):
        if field == 'name':
            return self.name_input
        elif field == 'surname':
            return self.surname_input
        elif field == 'email':
            return self.email_input
        elif field == 'password':
            return self.password_input
        elif field == 'confirm_password':
            return self.confirm_password_input
        else:
            return None
        
    #       ---- Fill inputs functions ----
    def fill_field(self, field, value):
        self.findField(field).send_keys(value)

    def fill_in_everything(self, name, surname, email, password, confirm_password):
        self.fill_field(name)
        self.fill_field(surname)
        self.fill_field(email)
        self.fill_field(password)
        self.fill_field(confirm_password)

    #       ---- Get input data functions ----
    def get_field_class(self, field):
        field = self.findField(field)
        return field.get_attribute('class')
    
    def get_field_error(self, field):
        field = self.findField(field)
        error = field.find_element(By.XPATH, 'following-sibling::div')
        return error.text

    def click_subscribe(self):
        try:
            self.subscribe_button = self.wait.until(EC.element_to_be_clickable((By.ID, 'Submit')))
            self.subscribe_button.click()
        except StaleElementReferenceException:
            self.subscribe_button = self.wait.until(EC.element_to_be_clickable((By.ID, 'Submit')))
            self.subscribe_button.click()

        


