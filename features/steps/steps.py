from behave import *
from selenium import webdriver
from features.pages.loginForm_page import *

@Given('I am on the login page')
def step_impl(context):
    context.driver = webdriver.Firefox()
    context.driver.get('http://localhost/Grasshopper/authentication/LoginForm.php')
    context.login_form = LoginFormPage(context.driver)

@When('I write Email')
def step_impl(context):
    context.login_form.enter_email('a@a.aa')

@Then('I should see it in the email field')
def step_impl(context):
    assert context.login_form.get_email() == 'a@a.aa'

