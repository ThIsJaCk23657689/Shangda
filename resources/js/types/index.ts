export interface StaffUser {
    id: number;
    name: string;
    email: string | null;
    jobTitleId: number | null;
    jobTitle: string | null;
}

export interface ConsumerUser {
    id: number;
    account: string;
    name: string;
    email: string | null;
    accountType: number;
}

export interface AuthState {
    staff: StaffUser | null;
    consumer: ConsumerUser | null;
}

export interface FlashMessages {
    success?: string;
    error?: string;
    warning?: string;
    info?: string;
}

export interface SharedPageProps {
    [key: string]: unknown;
    appName: string;
    auth: AuthState;
    permissions: string[];
    flash: FlashMessages;
}

export interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

export interface Paginated<T> {
    data: T[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
    from: number | null;
    to: number | null;
    links: PaginationLink[];
}
