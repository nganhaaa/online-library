import { useState, useEffect } from 'react';

interface CheckboxListProps {
    checkboxItems: { id: number; name: string; type: string }[];
    onCheck?: number; // Set default checked value
    onChange: (selectedItems: number[]) => void;
}

export default function CheckboxList({ checkboxItems, onCheck, onChange }: CheckboxListProps) {
    const [selectedItem, setSelectedItem] = useState<number | null>(null);

    useEffect(() => {
        // Set the initial state based on the onCheck prop
        if (onCheck) {
            setSelectedItem(onCheck);
        }
    }, [onCheck]);

    const handleCheckboxChange = (id: number) => {
        // If the clicked checkbox is already selected, deselect it; otherwise, select it
        const newSelectedItem = selectedItem === id ? null : id;
        setSelectedItem(newSelectedItem);
        onChange(newSelectedItem ? [newSelectedItem] : []); // Pass selected item to parent
    };

    return (
        <div>
            {checkboxItems.map((item) => (
                <label key={item.id} className="block">
                    <input
                        type="checkbox"
                        checked={selectedItem === item.id}
                        onChange={() => handleCheckboxChange(item.id)}
                    />
                    {item.name}
                </label>
            ))}
        </div>
    );
}
