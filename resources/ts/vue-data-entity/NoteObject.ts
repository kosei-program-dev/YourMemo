export interface NoteObject {
    id: number;
    comment: string;
    previewImage?: string;
    preview_image?: string;
    url: string;
    evaluation: number;
    created_at: Date;
}

export interface NoteApiResponse {
    data: Array<NoteObject>;
}
