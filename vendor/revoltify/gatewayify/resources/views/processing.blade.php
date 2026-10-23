<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment Verification</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f9fafb;
            color: #374151;
            line-height: 1.6;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            text-align: center;
            padding: 1rem;
        }

        .verification-card {
            max-width: 28rem;
            width: 100%;
            background: white;
            border-radius: 0.5rem;
            box-shadow:
                0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 2rem;
            border: 1px solid #e5e7eb;
        }

        .title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1.5rem;
        }

        .description {
            color: #6b7280;
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        .spinner-container {
            display: flex;
            justify-content: center;
            margin: 2rem 0;
        }

        .spinner {
            width: 2rem;
            height: 2rem;
            border: 4px solid #e5e7eb;
            border-top: 4px solid #2563eb;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .status-text {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 1rem;
        }

        .footer-note {
            margin-top: 2rem;
            font-size: 0.75rem;
            color: #9ca3af;
        }

        /* Responsive design */
        @media (max-width: 640px) {
            .verification-card {
                margin: 1rem;
                padding: 1.5rem;
            }

            .title {
                font-size: 1.25rem;
            }
        }

        /* Loading states */
        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="verification-card fade-in">
            <h2 class="title">Verifying Your Payment...</h2>
            <p class="description">{{ $message }}</p>
            <div class="spinner-container">
                <div class="spinner"></div>
            </div>
            <p class="status-text">This page will update automatically.</p>
            <p class="footer-note">Please do not close this window during verification.</p>
        </div>
    </div>

    <script>
        const checkUrl = @js($gatewayStatusUrl);
        const redirectUrl = @js($formActionUrl);

        async function checkStatus() {
            try {
                const response = await fetch(checkUrl, { headers: { Accept: "application/json" } });
                const data = await response.json();
                if (data.data && data.data.completed) {
                    window.location.href = redirectUrl;
                }
            } catch (error) {
                console.log("Status check failed:", error);
            }
        }

        setInterval(checkStatus, 10000);
    </script>
</body>
</html>
