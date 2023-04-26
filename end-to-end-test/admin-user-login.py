from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time

WAIT_TIMEOUT = 10

driver = webdriver.Chrome()

driver.get("http://localhost:8000/login")
wait = WebDriverWait(driver, WAIT_TIMEOUT)

#Unsuccessful login

email_field = wait.until(EC.element_to_be_clickable((By.NAME, "email")))
password_field = wait.until(EC.element_to_be_clickable((By.NAME, "password")))

email_field.send_keys("aiviskri@gmail.comBAD")
password_field.send_keys("adminBAD")
email_field.send_keys(Keys.RETURN)

email_field = wait.until(EC.element_to_be_clickable((By.NAME, "email")))
password_field = wait.until(EC.element_to_be_clickable((By.NAME, "password")))
email_value = email_field.get_attribute("value")
password_value = password_field.get_attribute("value")

assert email_value == "", "Login was successful"
assert password_value == "", "Login was successful"

#Successful login 
email_field = wait.until(EC.element_to_be_clickable((By.NAME, "email")))
password_field = wait.until(EC.element_to_be_clickable((By.NAME, "password")))

email_field.send_keys("aiviskri@gmail.com")
password_field.send_keys("admin")
email_field.send_keys(Keys.RETURN)


navbar = wait.until(EC.element_to_be_clickable((By.CLASS_NAME, "navbar")))
sidebar = wait.until(EC.element_to_be_clickable((By.ID, "_page_menu")))

assert navbar, "Unsuccessful login(Navbar not found)"
assert sidebar, "Unsuccessful login(Sidebar not found)"

driver.quit()