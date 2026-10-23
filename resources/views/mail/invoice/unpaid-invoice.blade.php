@if ($overdue)
Dear {name},

**Action needed: Invoice #{invoice_id} ({days_overdue} days overdue)**

Our records show invoice **#{invoice_id}** for **{amount}** was due on **{due_date}** and remains unpaid.

**Invoice details**
- Invoice: #{invoice_id}
- Amount due: {amount}
- Original due date: {due_date}
- Days overdue: {days_overdue}

{payment_button}

Or open this link: {payment_url}

If you've already paid, thank you—no further action is needed. Please allow 1-2 business days for processing. If you have questions or need a plan, just reply to this email.

{signature}
@else
Dear {name},

**Payment reminder: Invoice #{invoice_id} due {due_date}**

This is a friendly reminder that invoice **#{invoice_id}** for **{amount}** is due on **{due_date}**.

**Invoice summary**
- Invoice: #{invoice_id}
- Amount due: {amount}
- Due date: {due_date}
- Status: {status}

{payment_button}

Or open this link: {payment_url}

Need more time or have a question? Reply to this email and we'll be glad to help.

{signature}
@endif