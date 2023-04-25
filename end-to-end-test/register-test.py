from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time

WAIT_TIMEOUT = 30

driver = webdriver.Chrome()

driver.get("http://localhost:5173/login")

wait = WebDriverWait(driver, WAIT_TIMEOUT)

register_button = wait.until(EC.element_to_be_clickable((By.CLASS_NAME, "register-button")))
register_button.click()

email_field = wait.until(EC.element_to_be_clickable((By.NAME, "email")))
password_field = wait.until(EC.element_to_be_clickable((By.NAME, "password")))
confirm_password_field = wait.until(EC.element_to_be_clickable((By.NAME, "confirmPassword")))

#Test non matching passwords
email_field.send_keys("test@test.com")
password_field.send_keys("test")
confirm_password_field.send_keys("testDiff")
email_field.send_keys(Keys.RETURN)

alert_error = wait.until(EC.element_to_be_clickable((By.CLASS_NAME, "alert-error")))

assert "Password and Confirm Password do not match" in driver.page_source

#Test register user
confirm_password_field.clear()
confirm_password_field.send_keys("test")
confirm_password_field.send_keys(Keys.RETURN)

register_button = wait.until(EC.element_to_be_clickable((By.CLASS_NAME, "register-button")))

#Test same username not allowed
register_button.click()

email_field = wait.until(EC.element_to_be_clickable((By.NAME, "email")))
password_field = wait.until(EC.element_to_be_clickable((By.NAME, "password")))
confirm_password_field = wait.until(EC.element_to_be_clickable((By.NAME, "confirmPassword")))

email_field.send_keys("test@test.com")
password_field.send_keys("test")
confirm_password_field.send_keys("test")
email_field.send_keys(Keys.RETURN)

alert_error = wait.until(EC.element_to_be_clickable((By.CLASS_NAME, "alert-error")))

assert "This user is already registered." in driver.page_source

driver.quit()
