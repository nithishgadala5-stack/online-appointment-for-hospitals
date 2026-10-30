import streamlit as st
import pandas as pd
import matplotlib.pyplot as plt

from sklearn.linear_model import LinearRegression
from sklearn.model_selection import train_test_split
from sklearn.metrics import mean_absolute_error, r2_score

# Page settings
st.set_page_config(
    page_title="Student Performance Predictor",
    page_icon="🎓"
)

st.title("🎓 Student Performance Predictor")
st.write("Predict a student's final exam score using Machine Learning.")

# Load dataset
df = pd.read_csv("student_performance.csv")

# Features
X = df[
    [
        "study_hours",
        "attendance",
        "previous_score",
        "assignments_completed",
        "sleep_hours"
    ]
]

# Target
y = df["final_score"]

# Split dataset
X_train, X_test, y_train, y_test = train_test_split(
    X,
    y,
    test_size=0.2,
    random_state=42
)

# Train model
model = LinearRegression()
model.fit(X_train, y_train)

# Test model
y_pred = model.predict(X_test)

# Metrics
mae = mean_absolute_error(y_test, y_pred)
r2 = r2_score(y_test, y_pred)

# -------------------------
# Student Information
# -------------------------

st.header("📝 Enter Student Information")

study_hours = st.number_input(
    "Study Hours",
    min_value=0.0,
    max_value=24.0,
    value=5.0
)

attendance = st.number_input(
    "Attendance (%)",
    min_value=0.0,
    max_value=100.0,
    value=80.0
)

previous_score = st.number_input(
    "Previous Exam Score",
    min_value=0.0,
    max_value=100.0,
    value=70.0
)

assignments_completed = st.number_input(
    "Assignments Completed",
    min_value=0,
    max_value=10,
    value=7
)

sleep_hours = st.number_input(
    "Sleep Hours",
    min_value=0.0,
    max_value=24.0,
    value=7.0
)

# -------------------------
# Prediction History
# -------------------------

if "history" not in st.session_state:
    st.session_state.history = []

# -------------------------
# Prediction
# -------------------------

if st.button("🔮 Predict Final Score"):

    new_student = pd.DataFrame({
        "study_hours": [study_hours],
        "attendance": [attendance],
        "previous_score": [previous_score],
        "assignments_completed": [assignments_completed],
        "sleep_hours": [sleep_hours]
    })

    prediction = model.predict(new_student)[0]

    prediction = max(0, min(100, prediction))

    # Pass / Fail
    if prediction >= 40:
        result = "PASS"
    else:
        result = "FAIL"

    # Display prediction
    st.success(
        f"🎯 Predicted Final Score: {prediction:.2f}"
    )

    if result == "PASS":
        st.success("✅ Result: PASS")
    else:
        st.error("❌ Result: FAIL")

    # Save prediction
    st.session_state.history.append({
        "Study Hours": study_hours,
        "Attendance": attendance,
        "Previous Score": previous_score,
        "Assignments Completed": assignments_completed,
        "Sleep Hours": sleep_hours,
        "Predicted Score": round(prediction, 2),
        "Result": result
    })

# -------------------------
# Prediction History
# -------------------------

if st.session_state.history:

    st.header("📋 Prediction History")

    history_df = pd.DataFrame(
        st.session_state.history
    )

    st.dataframe(history_df, use_container_width=True)

    # Download button
    csv = history_df.to_csv(index=False)

    st.download_button(
        label="📥 Download Prediction History",
        data=csv,
        file_name="prediction_history.csv",
        mime="text/csv"
    )

# -------------------------
# Model Performance
# -------------------------

st.header("📊 Model Performance")

col1, col2 = st.columns(2)

with col1:
    st.metric(
        "Mean Absolute Error",
        f"{mae:.2f}"
    )

with col2:
    st.metric(
        "R² Score",
        f"{r2:.2f}"
    )

# -------------------------
# Graph
# -------------------------

st.header("📈 Study Hours vs Final Score")

fig, ax = plt.subplots()

ax.scatter(
    df["study_hours"],
    df["final_score"],
    color="blue"
)

ax.set_xlabel("Study Hours")
ax.set_ylabel("Final Score")
ax.set_title("Study Hours vs Final Score")

st.pyplot(fig)