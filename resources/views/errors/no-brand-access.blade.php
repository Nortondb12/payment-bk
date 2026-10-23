<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Access Denied - {{ config("app.name") }}</title>
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --background: #f9fafb;
            --card-bg: #ffffff;
            --text: #1f2937;
            --text-secondary: #4b5563;
            --border: #e5e7eb;
            --warning: #f59e0b;
            --error: #dc2626;
            --info: #0891b2;
        }
        @media (prefers-color-scheme: dark)
        {
                       :root {
                           --primary: #2563eb;
                           --primary-hover: #1e40af;
                           --background: #111827;
                           --card-bg: #1f2937;
                           --text: #f9fafb;
                           --text-secondary: #d1d5db;
                           --border: #374151;
                           --warning: #f59e0b;
                           --error: #dc2626;
                           --info: #0891b2;
                       }
                   }

                   * {
                       margin: 0;
                       padding: 0;
                       box-sizing: border-box;
                   }

                   body {
                       font-family:
                           -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans',
                           'Helvetica Neue', sans-serif;
                       background-color: var(--background);
                       color: var(--text);
                       line-height: 1.6;
                       min-height: 100vh;
                       display: flex;
                       justify-content: center;
                       align-items: center;
                       padding: 1rem;
                   }

                   .container {
                       max-width: 600px;
                       background-color: var(--card-bg);
                       border-radius: 12px;
                       box-shadow:
                           0 4px 6px rgba(0, 0, 0, 0.05),
                           0 1px 3px rgba(0, 0, 0, 0.1);
                       overflow: hidden;
                       width: 100%;
                   }

                   .header {
                       background: linear-gradient(135deg, var(--info) 0%, #0e7490 100%);
                       padding: 1.5rem;
                       text-align: center;
                       position: relative;
                   }

                   .header img {
                       height: 48px;
                       margin-bottom: 0.5rem;
                   }

                   .header h1 {
                       color: white;
                       font-size: 1.5rem;
                       font-weight: 600;
                       margin-bottom: 0.5rem;
                   }

                   .header p {
                       color: rgba(255, 255, 255, 0.9);
                       font-size: 0.875rem;
                   }

                   .logout-header {
                       position: absolute;
                       top: 1rem;
                       right: 1rem;
                   }

                   .content {
                       padding: 2rem;
                   }

                   .access-denied-box {
                       border-left: 4px solid var(--warning);
                       background-color: rgba(245, 158, 11, 0.05);
                       padding: 1rem;
                       margin-bottom: 1.5rem;
                       border-radius: 0 4px 4px 0;
                   }

                   .access-denied-box h2 {
                       color: var(--warning);
                       font-size: 1.125rem;
                       margin-bottom: 0.5rem;
                       display: flex;
                       align-items: center;
                       gap: 0.5rem;
                   }

                   .status-icon {
                       width: 20px;
                       height: 20px;
                   }

                   .brand-info {
                       background-color: rgba(8, 145, 178, 0.05);
                       border: 1px solid rgba(8, 145, 178, 0.2);
                       border-radius: 8px;
                       padding: 1rem;
                       margin-bottom: 1.5rem;
                   }

                   .brand-info h3 {
                       color: var(--info);
                       font-size: 1rem;
                       margin-bottom: 0.5rem;
                       display: flex;
                       align-items: center;
                       gap: 0.5rem;
                   }

                   .brand-info p {
                       color: var(--text-secondary);
                       font-size: 0.875rem;
                       margin-bottom: 0.5rem;
                   }

                   .brand-info .brand-name {
                       font-weight: 600;
                       color: var(--text);
                       background-color: rgba(8, 145, 178, 0.1);
                       padding: 0.25rem 0.5rem;
                       border-radius: 4px;
                       display: inline-block;
                       margin-top: 0.5rem;
                   }

                   .user-info {
                       background-color: rgba(99, 102, 241, 0.05);
                       border: 1px solid rgba(99, 102, 241, 0.2);
                       border-radius: 8px;
                       padding: 1rem;
                       margin-bottom: 1.5rem;
                   }

                   .user-info h3 {
                       color: var(--primary);
                       font-size: 1rem;
                       margin-bottom: 0.5rem;
                       display: flex;
                       align-items: center;
                       gap: 0.5rem;
                   }

                   .user-info p {
                       color: var(--text-secondary);
                       font-size: 0.875rem;
                       margin-bottom: 0.5rem;
                   }

                   .user-info .user-email {
                       font-weight: 600;
                       color: var(--text);
                   }

                   .next-steps {
                       margin-bottom: 1.5rem;
                   }

                   .next-steps h3 {
                       font-size: 1.125rem;
                       margin-bottom: 1rem;
                       color: var(--text);
                   }

                   .step {
                       display: flex;
                       margin-bottom: 1rem;
                       gap: 1rem;
                   }

                   .step-number {
                       background-color: var(--primary);
                       color: white;
                       width: 24px;
                       height: 24px;
                       border-radius: 50%;
                       display: flex;
                       align-items: center;
                       justify-content: center;
                       font-size: 0.875rem;
                       font-weight: 600;
                       flex-shrink: 0;
                   }

                   .step-content {
                       flex: 1;
                   }

                   .step-title {
                       font-weight: 600;
                       margin-bottom: 0.25rem;
                       color: var(--text);
                   }

                   .step-description {
                       color: var(--text-secondary);
                       font-size: 0.875rem;
                   }

                   .actions {
                       background-color: rgba(99, 102, 241, 0.05);
                       border-radius: 8px;
                       padding: 1rem;
                       margin-bottom: 1.5rem;
                       border: 1px solid var(--border);
                       text-align: center;
                   }

                   .actions h3 {
                       font-size: 1.125rem;
                       margin-bottom: 0.5rem;
                       color: var(--text);
                   }

                   .actions p {
                       color: var(--text-secondary);
                       font-size: 0.875rem;
                       margin-bottom: 1.5rem;
                   }

                   .button {
                       display: inline-block;
                       padding: 0.75rem 1.5rem;
                       border-radius: 6px;
                       text-decoration: none;
                       font-weight: 600;
                       font-size: 0.875rem;
                       transition: all 0.2s;
                       margin: 0.25rem;
                       cursor: pointer;
                       border: none;
                   }

                   .button-primary {
                       background-color: var(--primary);
                       color: white;
                   }

                   .button-primary:hover {
                       background-color: var(--primary-hover);
                       transform: translateY(-1px);
                   }

                   .button-outline {
                       background-color: transparent;
                       color: var(--primary);
                       border: 2px solid var(--primary);
                   }

                   .button-outline:hover {
                       background-color: var(--primary);
                       color: white;
                   }

                   .button-logout {
                       background-color: var(--error);
                       color: white;
                       font-size: 0.8rem;
                       padding: 0.5rem 1rem;
                   }

                   .button-logout:hover {
                       background-color: #b91c1c;
                       transform: translateY(-1px);
                   }

                   .button-info {
                       background-color: var(--info);
                       color: white;
                   }

                   .button-info:hover {
                       background-color: #0e7490;
                       transform: translateY(-1px);
                   }

                   .footer {
                       padding: 1.5rem;
                       text-align: center;
                       border-top: 1px solid var(--border);
                       color: var(--text-secondary);
                       font-size: 0.75rem;
                   }
        @media (max-width: 640px)
        {
                       .container {
                           border-radius: 8px;
                       }

                       .content {
                           padding: 1.5rem;
                       }

                       .button {
                           display: block;
                           margin: 0.5rem 0;
                       }

                       .logout-header {
                           position: static;
                           margin-bottom: 1rem;
                       }
                   }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logout-header">
                <form action="{{ route("logout") }}" method="POST" style="display: inline">
                    @csrf
                    <button type="submit" class="button button-logout">
                        <svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            style="margin-right: 0.25rem"
                        >
                            <path
                                d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9M16 17L21 12M21 12L16 7M21 12H9"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
            <img src="{{ asset("assets/images/logo-white.png") }}" alt="{{ config("app.name") }}" />
            <h1>Access Denied</h1>
            <p>You do not have permission to access this brand</p>
        </div>
        <div class="content">
            <div class="access-denied-box">
                <h2>
                    <svg class="status-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 15V17M12 7V13M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 12 7.02944 3 12C3 16.9706 7.02944 21 12 21Z"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                    Brand Access Restricted
                </h2>
                <p>You are currently logged in but do not have the necessary permissions to access this brand. This could be due to role restrictions, brand-specific access controls, or account limitations.</p>
            </div>
        </div>
        <div class="footer">&copy; {{ date("Y") }} {{ config("app.name") }}. All rights reserved.</div>
    </div>
</body>
</html>
