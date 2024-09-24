import requests
from behave import *
from features.pages.header_page import *
from features.pages.loginForm_page import *

HOMEPAGE_URL = 'http://localhost/Grasshopper'
LOGOUT_URL = 'http://localhost/Grasshopper/authentication/Logout.php'
LOGIN_STATUS_URL = 'http://localhost/Grasshopper/authentication/check_login_status.php'
LOGIN_FORM_URL = 'http://localhost/Grasshopper/authentication/LoginForm.php'

TESTING_EMAIL = 'JohnTester@Test.te'

def get_login_status():
    response = requests.get(LOGIN_STATUS_URL)
    return response.json().get('logged_in', False)

@Given('I am in the home page')
def step_impl(context):
    context.driver.get(HOMEPAGE_URL)
    context.header = HeaderPage(context.driver)

@Given('I am not logged in')
def step_impl(context):
    login_status = get_login_status()
    if(not login_status):
        context.driver.get(LOGOUT_URL)

@Given('I am logged in')
def step_impl(context):
    login_status = get_login_status()
    if(not login_status):
        context.driver.get(LOGIN_FORM_URL)
        context.LoginFormPage = LoginFormPage(context.driver)
        context.LoginFormPage.fill_in_everything(TESTING_EMAIL, 'password')
        context.LoginFormPage.click_login()