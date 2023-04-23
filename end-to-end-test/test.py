from colorama import Fore, Back, Style

passed_tests = 0
total_tests = 0
tests = []

def execute_test(test_name):
    print(f"{Back.BLUE}--- Running test: {test_name} ---{Style.RESET_ALL}")

    with open(test_name, "r") as file:
        global passed_tests, total_tests
        script_content = file.read()
        try:
            exec(script_content)
            print(f"{Back.GREEN}{test_name} PASSED{Style.RESET_ALL}")
            tests.append({"name": test_name, "passed": True})
            total_tests += 1
            passed_tests += 1
        except Exception as e:
            print(e)
            print(f"{Back.RED}{test_name} FAILED{Style.RESET_ALL}")
            tests.append({"name": test_name, "passed": False})
            total_tests += 1

def print_test_results():
    print(f"Passed tests: {passed_tests}/{total_tests}")
    print("Test results:")
    for test in tests:
        test_name = test["name"]
        if (test["passed"]):
            print(f"\t{Back.GREEN}{test_name} PASSED{Style.RESET_ALL}")
        else:
            print(f"\t{Back.RED}{test_name} FAILED{Style.RESET_ALL}")

if __name__ == "__main__":
    execute_test("login-test.py")
    execute_test("login-test.py")
    print_test_results()
