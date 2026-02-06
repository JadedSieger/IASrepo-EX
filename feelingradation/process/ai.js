document.getElementById("aiForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    const title = document.getElementById("title").value.trim();
    const message = document.getElementById("message").value.trim();
    const aiResponse = document.getElementById("aiResponse");
    const success = document.getElementById("success");
    const error = document.getElementById("error");

    if (!title || !message) return;

    aiResponse.value = "AI is thinking...";
    success.textContent = "";
    error.textContent = "";

    try {
        const response = await fetch("process/hf_api.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ title, message })
        });

        const data = await response.json();
        if (data.response) {
            aiResponse.value = data.response;
        } else {
            aiResponse.value = "Sorry, something went wrong.";
        }

        if (data.success) {
            success.textContent = data.success;
        }

        if (data.error) {
            error.textContent = data.error;
        }

    } catch (err) {
        aiResponse.value = "AI_ERROR: Could not reach the API.";
        console.error(err);
    }
});
