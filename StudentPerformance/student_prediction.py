'python'
import pandas as pd
import matplotlib.pyplot as plt

from sklearn.model_selection import train_test_split
from sklearn.linear_model import LinearRegression
from sklearn.metrics import mean_absolute_error, r2_score

# 1. Load the dataset
df = pd.read_csv("student_performance.csv")

# 2. Select the input features
X = df[
    [
        "study_hours",
        "attendance",
        "previous_score",
        "assignments_completed",
        "sleep_hours"
    ]
]

# 3. Select the value we want to predict
y = df["final_score"]

# 4. Split the data into training and testing data
X_train, X_test, y_train, y_test = train_test_split(
    X,
    y,
    test_size=0.2,
    random_state=42
)

# 5. Create the machine learning model
model = LinearRegression()

# 6. Train the model
model.fit(X_train, y_train)

print("Model trained successfully!")

# 7. Make predictions
y_pred = model.predict(X_test)

# 8. Check the model's accuracy
mae = mean_absolute_error(y_test, y_pred)
r2 = r2_score(y_test, y_pred)

print("Mean Absolute Error:", mae)
print("R2 Score:", r2)

# 9. Predict a new student's score
new_student = pd.DataFrame({
    "study_hours": [6],
    "attendance": [90],
    "previous_score": [80],
    "assignments_completed": [9],
    "sleep_hours": [7]
})

prediction = model.predict(new_student)

print("Predicted Final Score:", prediction[0])

# 10. Create a graph
plt.scatter(df["study_hours"], df["final_score"])

plt.xlabel("Study Hours")
plt.ylabel("Final Score")
plt.title("Study Hours vs Final Score")

plt.show()

